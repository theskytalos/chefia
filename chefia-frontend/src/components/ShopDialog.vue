<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" max-width="500">
            <v-card class="mr-auto my-3" max-width="500">
                <v-img height="250" v-bind:src="shop.shopLogoImage"></v-img>
                <v-card-title>{{ shop.shopName }}</v-card-title>
                <v-card-text>
                    <v-row align="center" class="mx-0">
                        <v-rating :value="4.5" color="amber" dense half-increments readonly size="14"></v-rating>
                        <div class="grey--text ml-4">4.5 (413)</div>
                    </v-row>
                    <div class="my-4 subtitle-1">
                        {{ shop.shopSpecialty }}
                    </div>
                    <div>{{ shop.shopDescription }}</div>
                    <v-divider class="my-2"></v-divider>
                    <div class="my-4 subtitle-1">
                        Endereço
                    </div>
                    CEP: {{ shop.shopCEP }}<br>
                    UF: {{ shop.shopUF }}<br>
                    Cidade: {{ shop.shopCity }}<br>
                    Bairro: {{ shop.shopNeighbourhood }}<br>
                    Rua: {{ shop.shopStreet }}<br>
                    <span v-if="shop.shopComplement !== ''">Complemento: {{ shop.shopComplement }}<br></span>
                    <span v-if="shop.shopReference !== ''">Referência: {{ shop.shopReference }}<br></span>
                    <v-divider class="my-2"></v-divider>
                    <div class="my-4 subtitle-1">
                        Contato
                    </div>
                    <v-list shaped>
                        <v-list-item-group color="primary">
                            <v-list-item v-for="(phone, index) in shop.shopPhoneNumbers" v-bind:key="index" v-bind:href="'tel:' + shop.shopPhoneNumber">
                                <v-list-item-icon>
                                    <v-icon v-if="phone.shopPhoneType == 2">mdi-cellphone</v-icon>
                                    <v-icon v-else>mdi-phone</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title v-text="phone.shopPhoneNumber"></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                    <v-divider class="my-2"></v-divider>
                    <div class="my-4 subtitle-1">
                        Mapa
                    </div>
                    <iframe v-bind:src="shop.shopMapUrl" width="450" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </v-card-text>
                <v-divider class="mx-4"></v-divider>
                <v-card-actions>
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
    name: 'ShopDialog',
    data () {
        return {

        }
    },
    props: {
        shop: Object
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