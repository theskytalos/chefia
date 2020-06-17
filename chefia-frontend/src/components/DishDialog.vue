<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" max-width="374">
            <v-card class="mr-auto my-3" max-width="374">
                <v-img height="250" src="https://cdn.vuetifyjs.com/images/cards/cooking.png"></v-img>
                <v-card-title>{{ item.menuItemName }}</v-card-title>
                <v-card-text>
                    <v-row align="center" class="mx-0">
                        <v-rating :value="4.5" color="amber" dense half-increments readonly size="14"></v-rating>
                        <div class="grey--text ml-4">4.5 (413)</div>
                    </v-row>
                    <div class="my-4 subtitle-1">
                        R$ {{ item.menuItemPrice }}
                    </div>
                    <div>{{ item.menuItemDescription }}</div>
                </v-card-text>
                <v-divider class="mx-4"></v-divider>
                <v-card-actions>
                    <v-btn text color="indigo">
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
export default {
    name: 'DishDialog',
    data () {
        return {
            
        }
    },
    props: {
        item: Object
    },
    computed: {
        dialog: {
            get() {
                return this.$attrs.value;
            },
            set(value) {
                this.$emit('input', value);
            }
        }
    }
}
</script>

<style scoped>

</style>