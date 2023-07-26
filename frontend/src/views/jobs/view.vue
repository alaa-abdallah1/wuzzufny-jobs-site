<template>
  <div>
    <v-container v-if="!loader.loading">
      <v-layout row wrap>
        <v-col
          md="9"
          sm="8"
          xs="12"
          :class="[$vuetify.breakpoint.xs ? 'text-center' : '', 'xs-12']"
          order="5"
        >
          <v-card class="pa-3">
            <div class="head">
              <div class="jobName">
                <v-btn
                  v-if="loggedIn"
                  small
                  class="float-right ml-4 mb-2"
                  outlined
                  :loading="bookmarkLoading"
                  @click="bookmark"
                  :color="bookmarked ? 'primary' : 'success'"
                  ref="bookmark"
                >
                  <span v-if="bookmarked">
                    <span
                      :class="['mr-1', $vuetify.breakpoint.xs ? 'd-none' : '']"
                      >Bookmarked</span
                    >
                    <v-icon>mdi-bookmark-off-outline</v-icon>
                  </span>
                  <span v-else>
                    <span
                      :class="['mr-1', $vuetify.breakpoint.xs ? 'd-none' : '']"
                      >Bookmark</span
                    >
                    <v-icon>mdi-bookmark-outline</v-icon>
                  </span>
                </v-btn>

                <h1 class="headline  mainColor--text">{{ job.name }}</h1>
                <p class="caption">
                  {{ job.title }}
                </p>
              </div>
            </div>
            <div class="datails">
              <v-row>
                <v-col
                  class="text-center"
                  sm="4"
                  v-for="(info, index) in jobInfo"
                  :key="index"
                >
                  <h3 class="caption font-weight-bold">
                    <v-icon small class="mr-2">mdi-information-outline</v-icon>
                    <span>{{ info.name.toUpperCase() }}</span>
                  </h3>
                  <p class="caption">{{ info.value }}</p>
                </v-col>
              </v-row>
            </div>
            <div class="jobDesc">
              <h1 class="headline  mainColor--text">Job Description</h1>
              <p class="caption">
                {{ job.description }}
              </p>
            </div>
            <div class="jobDesc">
              <h1 class="headline  mainColor--text">Qualifications</h1>
              <p class="caption">
                {{ job.qualifications }}
              </p>
            </div>
            <div class="skills mb-4">
              <h1 class="headline mb-2  mainColor--text">Skills</h1>
              <v-chip
                color="mainColor"
                outlined
                class="ma-1"
                v-for="(skill, index) in job.skills"
                :key="index"
              >
                <span
                  :class="$vuetify.theme.dark ? 'white--text' : 'black--text'"
                  >{{ skill }}</span
                >
              </v-chip>
            </div>
          </v-card>
          <center>
            <v-btn
              v-if="loggedIn"
              small
              class="white--text my-8 no-text-transform"
              color="mainColor"
              outlined
              x-large
              :disabled="applied"
              @click="apply"
              block
            >
              <span v-if="!applied">Apply Now For This Job</span>
              <span v-else
                >You've Applied Wait
                <br :class="$vuetify.breakpoint.xs ? 'd-block' : 'd-none'" />For
                Employer Response</span
              >
            </v-btn>
            <v-btn
              v-else
              small
              class="white--text my-8 no-text-transform"
              color="mainColor"
              outlined
              x-large
              :disabled="applied"
              block
              router
              to="/sign-in"
            >
              <span>Login To Apply</span>
            </v-btn>
          </center>
          <v-card class="mt-4 pa-4">
            <div class="smilarJobs">
              <h1 class="headline mb-2 mainColor--text">Smilar Jobs</h1>
              <v-chip
                color="mainColor"
                outlined
                class="ma-1"
                v-for="(similarJob, index) in similarJobs
                  ? similarJobs.slice(0, 20)
                  : ''"
                :key="index"
              >
                <router-link :to="`/job/view/${similarJob.id}`">
                  <span
                    :class="$vuetify.theme.dark ? 'white--text' : 'black--text'"
                    >{{ similarJob.name }}
                  </span>
                </router-link>
              </v-chip>
            </div>
          </v-card>
        </v-col>
        <v-col
          xs="12"
          :class="[$vuetify.breakpoint.xs ? 'text-center' : '', 'xs-12']"
          order="1"
        >
          <v-card class="pa-3 pb-7 ">
            <div class="name">
              <p class="text-center">Job Posted By</p>
              <center>
                <v-avatar class="mb-2" size="70">
                  <img :src="job.user.avatar" alt="John" />
                </v-avatar>
              </center>
              <p class="font-weight-bold mainColor--text text-center">
                <router-link
                  class="mainColor--text"
                  :to="`/profile/view/${job.user.id}`"
                >
                  {{ job.user.name }}</router-link
                >
              </p>
            </div>
            <div class="text-center mt-3">
              <div class="job">
                <span class="caption" v-if="job.user.info">
                  {{ job.user.info.slice(0, 90) }} ... etc
                </span>
              </div>
            </div>
          </v-card>
          <v-card class="mt-10 pa-4 companyInfo">
            <h3 class="headline ml-4  mainColor--text text-center">
              About Company
            </h3>
            <v-img class="ma-4" aspect-ratio="1.7" :src="`${job.logo}`"></v-img>
            <h4 class=" text-center">{{ job.companyName }}</h4>
            <p class="caption ml-4">
              {{ job.aboutCompany }}
            </p>
          </v-card>
        </v-col>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import { mapState, mapGetters, mapActions } from "vuex";

export default {
  metaInfo() {
    return {
      title: this.job.name
    };
  },
  data() {
    return {
      job: {},
      similarJobs: {},
      loading: false,
      bookmarked: false,
      bookmarkLoading: false,
      applied: false
    };
  },
  computed: {
    ...mapState(["loader"]),
    ...mapGetters(["loggedIn"]),
    id() {
      return this.$route.params.id;
    },
    jobInfo() {
      return [
        { name: "salary", value: "$ " + this.job.salary },
        { name: "type", value: this.job.type },
        {
          name: "experience",
          value:
            this.job.experience.from + " : " + this.job.experience.to + " years"
        },
        { name: "country", value: this.job.country },
        { name: "address", value: this.job.address },
        { name: "published at", value: this.job.created_at }
      ];
    }
  },
  methods: {
    ...mapActions({
      loadingStatus: "loader/loadingStatus"
    }),
    getData() {
      this.loadingStatus(true);
      this.axios.get(`api/job/view/${this.id}`).then(res => {
        this.job = res.data.job;
        this.similarJobs = res.data.similarJobs;
        this.bookmarked = this.job.bookmarks.length != 0 ? true : false;
        this.applied = this.job.applies.length != 0 ? true : false;
        this.loadingStatus(false);
      });
    },
    bookmark() {
      this.bookmarkLoading = true;
      this.axios.post(`api/job/bookmark/${this.id}`).then(res => {
        this.bookmarked = res.data;
        this.bookmarkLoading = false;
      });
    },
    apply() {
      this.axios.post(`api/job/apply/${this.id}`).then(() => {
        this.applied = true;
      });
    }
  },
  created() {
    this.getData();
  },
  watch: {
    id() {
      this.getData();
    }
  }
};
</script>

<style scoped>
.userInfo .v-image {
  height: 70px;
  width: 70px;
  display: inline-block;
}

.name img {
  object-fit: cover;
}

.userInfo .job {
  float: right;
  width: calc(100% - 80px);
}

.headline {
  font-weight: bold;
}
</style>
