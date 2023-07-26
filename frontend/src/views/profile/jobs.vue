<template>
  <div>
    <Skeleton v-if="loading" type="table" />
    <div v-else>
      <template>
        <v-row justify="center">
          <v-dialog v-model="dialogDelete" max-width="500px" persistent>
            <v-card>
              <v-card-title class="headline"
                >Are you sure you want to delete this item?</v-card-title
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text @click="closeDelete" :disabled="btnLoading"
                  >Cancel</v-btn
                >
                <v-btn
                  color="error darken-1"
                  text
                  @click="deleteItemConfirm"
                  :loading="btnLoading"
                  >OK</v-btn
                >
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-row>
      </template>

      <v-container>
        <v-layout row wrap>
          <v-col md="12">
            <v-card-title class="mainColor--text">
              My Jobs
              <v-spacer></v-spacer>
              <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
              ></v-text-field>
            </v-card-title>
            <v-data-table
              :headers="headers"
              :items="items"
              v-bind="bindOptions"
              :search="search"
              item-style="cursor: pointer"
            >
              <template slot="item.actions" scope="{item}">
                <div class="my-4 ">
                  <v-btn
                    router
                    :to="`/job/${item.id}/edit`"
                    text
                    small
                    color="cyan"
                  >
                    <v-icon dark>
                      mdi-pencil
                    </v-icon>
                  </v-btn>
                  <v-btn
                    @click.stop="deleteItem(index, item.id)"
                    color="#fff"
                    small
                    text
                  >
                    <v-icon color="error">mdi-delete</v-icon>
                  </v-btn>
                  <v-btn @click.stop="clickRow(item)" color="#fff" small text>
                    <v-icon elevation="2" color="#fff">mdi-eye</v-icon>
                  </v-btn>
                </div>
              </template>
            </v-data-table>
          </v-col>
        </v-layout>
      </v-container>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
  metaInfo() {
    return {
      title: 'My Jobs'
    }
  },
  data() {
    return {
      items: [],
      loading: false,
      btnLoading: false,
      confirmBox: false,
      process: false,
      search: '',
      dialog: false,
      dialogDelete: false,
      index: -1,
      itemId: 1
    }
  },
  computed: {
    ...mapState(['loader']),

    bindOptions() {
      return {
        dense: true
      }
    },
    headers() {
      return [
        {
          text: 'Name',
          sortable: true,
          value: 'name'
        },
        {
          text: 'Actions',
          align: 'center',
          value: 'actions'
        }
      ]
    }
  },
  methods: {
    ...mapActions({
      popupData: 'popup/popupData'
    }),
    getData() {
      this.loading = true
      this.axios.get(`api/user/jobs`).then(res => {
        this.items = res.data
        this.loading = false
      })
    },
    deleteItem(index, itemId) {
      this.popupData({ show: false })
      this.index = index
      this.itemId = itemId
      this.dialogDelete = true
    },

    deleteItemConfirm() {
      this.btnLoading = true
      this.axios.delete(`api/job/${this.itemId}`).then(res => {
        this.items.splice(this.index, 1)
        this.closeDelete()
        this.btnLoading = false
        this.popupData({
          show: true,
          text: res.data.msg
        })
      })
    },
    closeDelete() {
      this.dialogDelete = false
      this.index = ''
      this.itemId = ''
    },
    clickRow(row) {
      this.$router.push(`/job/view/${row.id}`)
    }
  },
  created() {
    this.getData()
  }
}
</script>
