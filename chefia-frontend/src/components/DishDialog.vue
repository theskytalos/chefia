<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" max-width="500">
            <v-card class="mr-auto my-3" max-width="500">
                <v-img height="250" src="https://cdn.vuetifyjs.com/images/cards/cooking.png"></v-img>
                <v-card-title>{{ item.itemName }}</v-card-title>
                <v-card-text>
                    <v-row align="center" class="mx-0">
                        <v-rating :value="4.5" color="amber" dense half-increments readonly size="14"></v-rating>
                        <div class="grey--text ml-4">4.5 (413)</div>
                    </v-row>
                    <div class="my-4 subtitle-1 green--text">
                        R$ {{ item.itemPrice }}
                    </div>
                    <div>{{ item.itemDescription }}</div>
                    <v-divider class="my-2"></v-divider>
                    Quantidade
                    <v-row>
                        <v-col class="col-5">
                            <v-text-field min="1" max="15" v-model="quantity" type="number"></v-text-field>
                        </v-col>
                    </v-row>
                    <v-divider class="mb-2"></v-divider>
                    Observações
                    <v-textarea rows="2" no-resize clearable v-model="observations"></v-textarea>
                </v-card-text>
                <v-divider class="mx-4"></v-divider>
                <v-card-actions>
                    <v-btn text color="indigo" v-on:click.stop="addToCartHandler(item, quantity, observations); dialog = false">
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
            quantity: 1,
            observations: ""
        }
    },
    props: {
        item: Object,
        addToCartHandler: Function
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
    },
    watch: {
        dialog() {
            this.quantity = 1;
            this.observations = "";
        }
    }
}
</script>

<style scoped>

</style>