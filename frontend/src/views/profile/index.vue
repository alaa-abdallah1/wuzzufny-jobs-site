<template>
  <div>
    <Skeleton v-if="loading" type="card-avatar, article, article" />
    <v-container v-else>
      <v-layout row wrap>
        <v-col class="top-section" :style="cover()">
          <div style="position: relative">
            <v-btn
              v-if="loggedIn && isUserProfile"
              class="mx-2 chatBtn"
              router
              to="/profile/edit"
              fab
              dark
              color="mainColor"
            >
              <v-icon dark>
                mdi-pencil
              </v-icon>
            </v-btn>
          </div>
          <div class="profile-pic pa-10">
            <img
              class="profile-pic round"
              :src="user.avatar ? user.avatar : getImgUrl()"
            />
            <h2 class="headline mainColor--text font-weight-bold">
              {{ user.name }}
            </h2>
          </div>
        </v-col>
      </v-layout>

      <v-row class="information">
        <v-flex sm4 xs12 class="contact">
          <p class="overline" v-for="(info, index) in information" :key="index">
            <v-icon color="mainColor" class="pr-2">{{ info.icon }}</v-icon>
            <span>{{ info.text }}</span>
          </p>
        </v-flex>
        <v-flex sm8 xs12>
          <p v-if="user.info" class="overline mt-2">
            {{ user.info }}
          </p>
          <div v-if="user.skills?.length" class="text-center skills mt-10">
            <h2 class="title mainColor--text">Skills</h2>
            <v-chip
              outlined
              class="ma-2 mainColor"
              v-for="(skill, index) in user.skills"
              :key="index"
            >
              {{ skill }}
            </v-chip>
          </div>
        </v-flex>
      </v-row>

      <v-row class="px-4">
        <v-btn
          v-if="!user.skills?.length"
          small
          class="white--text my-8 no-text-transform"
          color="mainColor"
          outlined
          x-large
          @click="() => $router.push('/profile/edit')"
          block
        >
          <v-icon class="mr-2">mdi-account-question-outline </v-icon>
          Complete your profile
        </v-btn>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  metaInfo() {
    return {
      title: 'Profile'
    }
  },
  data() {
    return {
      user: {},
      loading: true
    }
  },
  computed: {
    ...mapState({
      authUser: 'user'
    }),
    background() {
      return require('@/assets/images/bg-cover.jpg')
    },
    isUserProfile() {
      return this.user.id === this.authUser.id
    },
    id() {
      return this.$route.params.id
    },
    loggedIn() {
      return this.$store.getters.loggedIn
    },
    information() {
      const info = [
        {
          icon: 'mdi-email-check-outline',
          text: this.user.email
        },
        {
          icon: 'mdi-folder-open',
          text: this.user.job
        },
        {
          icon: 'mdi-cellphone',
          text: this.user.phone
        },
        {
          icon: 'mdi-location-enter',
          text: this.user.country
        },
        {
          icon: 'mdi-gender-female',
          text: this.user.gender
        }
      ]

      return info.filter(({ text }) => text)
    }
  },
  methods: {
    cover() {
      var bgImage
      if (this.$vuetify.theme.dark) {
        bgImage = require('@/assets/images/bg-cover-dark.jpg')
      } else {
        bgImage = require('@/assets/images/bg-cover.jpg')
      }

      return {
        backgroundImage: `url("${bgImage}")`
      }
    },
    getImgUrl() {
      return require('@/assets/images/profile-pic.jpg')
    },
    getUserData() {
      this.axios.get(`api/profile/${this.id}`).then(res => {
        this.user = res.data
        this.loading = false
      })
    },
    setUserDate() {
      if (this.id) {
        this.getUserData()
      } else {
        if (this.loggedIn) {
          this.user = this.authUser
          this.loading = false
        } else {
          this.$router.push('/sign-in')
        }
      }
    }
  },
  created() {
    this.setUserDate()
  },
  watch: {
    id() {
      this.setUserDate()
    }
  }
}
</script>
<style scoped>
.top-section {
  /* box-shadow: 0px 3px 1px -2px rgb(0 0 0 / 20%),
    0px 2px 2px 0px rgb(0 0 0 / 14%), 0px 1px 5px 0px rgb(0 0 0 / 12%); */
  margin-bottom: 20px;
  background: url('../../assets/images/bg-cover.jpg');
  background-size: 100%;
}
.profile-pic img {
  width: 150px;
  height: 150px;
  border: 0.5px solid #eee;
  border-radius: 50%;
  object-fit: cover;
}
.information {
  margin-left: 5px;
}

@media screen and (max-width: 767px) {
  .information {
    text-align: center;
    margin-left: 0px;
  }
  .top-section {
    box-shadow: none;
    text-align: center;
    background: none !important;
  }
}
.chatBtn {
  position: absolute;
  right: 10px;
  top: 10px;
}
</style>
<style>
.profile .v-skeleton-loader__avatar {
  margin: auto !important;
}
.profile .v-skeleton-loader__heading {
  margin: 10px auto !important;
}
.profile .v-skeleton-loader__paragraph {
  width: 40%;
  display: inline-block;
  margin-right: 7%;
  margin-bottom: 20px;
}
.profile .v-skeleton-loader__paragraph {
  background-color: transparent !important;
  float: right;
}
</style>
