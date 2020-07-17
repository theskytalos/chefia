<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" max-width="700">
            <v-card class="mx-auto" max-width="700">
                <h1 class="text-center pt-5">Nos envie sua sugestão!</h1>
                <v-card-text>
                    <v-textarea rows="2" no-resize clearable v-model="sugestionText"></v-textarea>
                </v-card-text>
                <v-card-actions>
                    <v-btn text color="indigo" v-on:click="sendSugestion();">
                        Adicionar
                    </v-btn>
                    <v-btn text color="red" v-on:click.stop="dialog = false">
                        Fechar
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
import Api from '../services/Api';

export default {
    name: 'SugestionDialog',
    props: {

    },
    data () {
        return {
            sugestionText: '',
            snackbar: false,
            snackbarText: ''
        }
    },
    methods: {
        sendSugestion() {
            Api().post("SugestionView.php", { apiRequest: 'create', sugestionText: this.sugestionText })
                .then((response) => {
                    console.log(response.data);
                    if (response.data.success) {
                        this.snackbarText = response.data.content;
                        this.snackbar = true;
                        this.dialog = false;
                    } else {
                        if (!response.data.content)
                            return;
                            
                        this.snackbarText = response.data.content;
                        this.snackbar = true;
                    }
                }).catch((error) => {
                    console.log(error);
                });
        }
    },
    computed: {
        dialog: {
            get() {
                return this.$attrs.value;
            },
            set(value) {
                this.$emit('input', value);
                this.sugestionText = "";
            }
        }
    }
}
</script>