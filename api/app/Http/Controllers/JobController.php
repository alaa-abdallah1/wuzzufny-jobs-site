<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\Bookmark;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $name = $r->query('name');
        if ($r->query('country')) {
            $countries = explode(',', $r->query('country'));
        } else {
            $countries = [];
        }
        // return $countries;
        return response()
            ->json(Job::where('name', 'like', '%' . $name . '%')
                ->when($countries, function ($query, $countries) {
                    return $query->whereIn('country', $countries);
                })
                // ->whereIn('country', $countries)
                ->orderBy('id', 'desc')
                ->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:10|max:40',
                'title' => 'required|min:10|max:60',
                'description' => 'required|min:200|max:2000',
                'qualifications' => 'required|min:100|max:2000',
                'experience->from' => 'required|integer|min:0|max:49|lt:experience->to',
                'experience->to' => 'required|integer|min:1|max:50|gte:experience->from',
                'country' => 'required',
                'address' => 'required|min:20|max:100',
                'skills' => 'required|array|min:3',
                'skills.*' => 'string|exists:skills,name',
                'salary' => 'required|integer',
                'type' => 'required', Rule::in(['Full Time', 'Part Time']),
                'companyName' => 'required|min:2|max:40',
                'aboutCompany' => 'required|min:50|max:1000',
                'status' => 'required|boolean',
                'logo' => 'required|image',
            ],
            [ // Customize messages of fields

                'skills.min' => 'you must choose at least 3 items',
            ],
            [ // Customize name of fields
                'experience->from' => 'Experience From',
                'experience->to' => 'Experience To',

            ],
        );

        $request->merge(['user_id' => Auth::id()]);
        $job = Job::create($request->all());
        if ($request->hasFile('logo') && !empty($request->file('logo'))) {
            $path = $request->file('logo')->store('images/jobs', 's3');
            $job->logo = Storage::disk('s3')->url($path);
            $job->save();
        }
        return response()->json(['job' => $job, 'msg' => 'You Created This job successfully']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $job = Job::with(['user:id,name,job,info,avatar', 'bookmarks', 'applies'])->find($job->id);
        $similarJobs = [];
        foreach ($job->skills as $skill) {
            $similarJobs[] = Job::where('skills', 'like', '%' . $skill . '%')->where('id', '<>', $job->id)->get();
        }
        return response()->json(['job' => $job, 'similarJobs' => $similarJobs[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return $job->makeVisible(['status']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $request->validate(
            [
                'name' => 'required|min:10|max:40',
                'title' => 'required|min:10|max:60',
                'description' => 'required|min:200|max:2000',
                'qualifications' => 'required|min:100|max:2000',
                'experience->from' => 'required|integer|min:1|max:5|lt:experience->to',
                'experience->to' => 'required|integer|min:1|max:20|gte:experience->from',
                'country' => 'required',
                'address' => 'required|min:20|max:100',
                'skills' => 'required|min: 3',
                'salary' => 'required|integer',
                'type' => 'required', Rule::in(['Full Time', 'Part Time']),
                'companyName' => 'required|min:2|max:40',
                'aboutCompany' => 'required|min:50|max:1000',
                'status' => 'required|boolean',
                // 'logo' => 'nullable|image',
            ],
            [ // Customize messages of fields

                'skills.min' => 'you must choose at least 3 items',
            ],
            [ // Customize name of fields
                'experience->from' => 'Experience From',
                'experience->to' => 'Experience To',

            ],
        );

        // $request->merge(['user_id' => Auth::id()]);
        $jobCreatorID = $job->user()->first('id')->id;
        if ($job && $jobCreatorID === Auth::id()) { //check if user can edit this job
            $job->update($request->except('logo'));
            if ($request->hasFile('logo') && !empty($request->file('logo'))) {
                if (!empty($job->logo)) {
                    $file_path = parse_url($job->logo);
                    Storage::disk('s3')->delete($file_path); // delete old pic
                }
                $path = $request->file('logo')->store('images/jobs', 's3');
                $job->logo = Storage::disk('s3')->url($path);
                $job->save();
            }

            return response()->json(['job' => $job, 'msg' => 'You updated this job successfully']);
        } else {
            return response()->json(['msg' => "You Can't Edit This Job"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $jobCreatorID = $job->user()->first('id')->id;
        if ($job && $jobCreatorID === Auth::id()) { //check if user can delete this job

            $job->delete();
            return response()->json(['msg' => 'You Deleted This Job  Successfully'], 200);
        } else {
            return response()->json(['msg' => "You Can't Delete This Joby"], 422);
        }
    }

    /**
     * Bookmark This Job.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookmark(Job $job)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())->where('job_id', $job->id)->get();
        if (count($bookmark) == 0) {
            Bookmark::create([
                'user_id' => Auth::id(),
                'job_id' => $job->id,
            ]);
            return true;
        } else {
            Bookmark::where('user_id', Auth::id())->where('job_id', $job->id)->delete();
            return false;
        }
    }
    /**
     * Apply On This Job.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apply(Job $job)
    {
        $apply = Apply::where('user_id', Auth::id())->where('job_id', $job->id)->get();
        if (count($apply) == 0) {
            Apply::create([
                'user_id' => Auth::id(),
                'job_id' => $job->id,
            ]);
            return true;
        } else {
            return "You've Already Applied";
        }
    }
}
