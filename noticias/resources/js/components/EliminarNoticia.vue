<template>
    <input
        type="submit"
        class="btn btn-danger d-block w-100 mb-2"
        value="Eliminar x"
        @click="eliminarNoticia"
    />
</template>

<script>
export default {
    props: ["noticiaId"],
    methods: {
        eliminarNoticia() {
            this.$swal({
                title: "¿Deseas eliminar esta noticia?",
                text: "Una vez eliminada, no se puede recuperar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si",
                cancelButtonText: "No"
            }).then(result => {
                if (result.value) {
                    const params = {
                        id: this.noticiaId
                    };

                    // Enviar la petición al servidor
                    axios
                        .post(`/noticias/${this.noticiaId}`, {
                            params,
                            _method: "delete"
                        })
                        .then(respuesta => {
                            this.$swal.fire({
                                title: "Noticia eliminada",
                                text: "Se eliminó la noticia",
                                icon: "success"
                            });

                            // Eliminar noticia del DOM
                            this.$el.parentNode.parentNode.parentNode.removeChild(
                                this.$el.parentNode.parentNode
                            );
                        })
                        .catch(error => {});
                }
            });
        }
    }
};
</script>
