<template>
    <div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Gestión de empleados</h2>
                </div>
                <div class="pull-right">
                    <button
                        @click="changeModal()"
                        type="button"
                        class="btn btn-primary"
                    >
                        Crear nuevo empleado
                    </button>
                </div>
            </div>
        </div>
        <div class="alert-success">
            <p>{{ message }}</p>
        </div>

        <!-- Modal -->
        <div class="modal fade" :class="{ show: modal }">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ titleModal }}
                        </h5>
                        <button
                            @click="changeModal()"
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert-danger">
                            <pre>{{ errorMessage }}</pre>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row">
                                    <strong class="col-sm-2 col-form-label"
                                        >Código:</strong
                                    >
                                    <div class="col-sm-10">
                                        <input
                                            :disabled="disabled == 1"
                                            type="text"
                                            name="code"
                                            class="form-control"
                                            placeholder="Ingresa el código"
                                            v-model="employee.code"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row">
                                    <strong class="col-sm-2 col-form-label"
                                        >Nombre:</strong
                                    >
                                    <div class="col-sm-10">
                                        <input
                                            :disabled="disabled == 1"
                                            type="text"
                                            name="name"
                                            class="form-control"
                                            placeholder="Ingresa un nombre"
                                            v-model="employee.name"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row">
                                    <strong class="col-sm-2 col-form-label"
                                        >Apellido Paterno:</strong
                                    >
                                    <div class="col-sm-10">
                                        <input
                                        :disabled="disabled == 1"
                                            type="text"
                                            name="paternal_surname"
                                            class="form-control"
                                            placeholder="Ingresa un apellido paterno"
                                            v-model="employee.paternal_surname"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row">
                                    <strong class="col-sm-2 col-form-label"
                                        >Apellido Materno:</strong
                                    >
                                    <div class="col-sm-10">
                                        <input
                                        :disabled="disabled == 1"
                                            type="text"
                                            name="maternal_surname"
                                            class="form-control"
                                            placeholder="Ingresa un apellido materno"
                                            v-model="employee.maternal_surname"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row">
                                    <strong class="col-sm-2 col-form-label"
                                        >Correo electronico:</strong
                                    >
                                    <div class="col-sm-10">
                                        <input
                                        :disabled="disabled == 1"
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            placeholder="Ingresa un correo electronico"
                                            v-model="employee.email"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row">
                                    <strong class="col-sm-2 col-form-label"
                                        >Tipo de contrato:</strong
                                    >
                                    <div class="col-sm-10">
                                        <select
                                            name="type_of_contract"
                                            class="form-control"
                                            v-model="
                                                employee.type_of_contract_id
                                            "
                                        >
                                            <option
                                                v-for="type_of_contract of type_of_contracts"
                                                :key="type_of_contract.id"
                                                v-bind:value="
                                                    type_of_contract.id
                                                "
                                                :selected="
                                                    type_of_contract.id ==
                                                        employee.type_of_contract_id
                                                "
                                                :disabled="disabled == 1"
                                            >
                                                {{ type_of_contract.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row">
                                    <strong class="col-sm-2 col-form-label"
                                        >Estatus:</strong
                                    >
                                    <div class="col-sm-10">
                                        <select
                                            name="status"
                                            class="form-control"
                                            v-model="employee.status"
                                        >
                                            <option
                                                v-bind:value="1"
                                                :selected="employee.status == 1"
                                                :disabled="disabled == 1"
                                                >Activo</option
                                            >
                                            <option
                                                v-bind:value="0"
                                                :selected="employee.status == 0"
                                                :disabled="disabled == 1"
                                                >Inactivo</option
                                            >
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            @click="changeModal()"
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            {{disabled == 1? 'Cerrar':'Cancelar'}}
                        </button>
                        <button v-if="disabled==0" @click="save(employee)" class="btn btn-primary">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo Electronico</th>
                    <th>Tipo de contrato</th>
                    <th>Estado</th>
                    <th width="280px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="employee of employees" :key="employee.id">
                    <th scope="row">{{ employee.id }}</th>
                    <td>{{ employee.code }}</td>
                    <td>{{ employee.name }}</td>
                    <td>{{ employee.paternal_surname }}</td>
                    <td>{{ employee.maternal_surname }}</td>
                    <td>{{ employee.email }}</td>
                    <td>{{ employee.type_of_contract.name }}</td>
                    <td>{{ employee.status == 1 ? "Activo" : "Inactivo" }}</td>
                    <td>
                        <button @click="changeModal(employee.id, 1)" class="btn btn-info" type="button">
                            Ver detalle
                        </button>

                        <button
                            @click="changeModal(employee.id)"
                            class="btn btn-warning"
                            type="button"
                        >
                            Editar
                        </button>

                        <button
                            @click="changeStatus(employee.id)"
                            v-bind:class="[
                                employee.status != 1
                                    ? 'btn btn-success'
                                    : 'btn btn-danger',
                                {}
                            ]"
                            type="button"
                        >
                            {{
                                employee.status != 1 ? "Activar" : "Desactivar"
                            }}
                            empleado
                        </button>

                        <button
                            @click="remove(employee.id)"
                            class="btn btn-danger"
                        >
                            Eliminar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button
            v-if="page != 1"
            @click="pagination(page - 1)"
            type="button"
            class="btn btn-secondary"
        >
            Anterior
        </button>
        <button
            v-if="totalPages > page"
            @click="pagination(page + 1, 1)"
            class="btn btn-secondary"
        >
            Siguiente
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            employee: {
                code: "",
                name: "",
                paternal_surname: "",
                maternal_surname: "",
                type_of_contract_id: 1,
                email: "",
                status: 1
            },
            disabled: 0,
            titleModal: "",
            modal: false,
            page: 1,
            limit: 2,
            employees: [],
            type_of_contracts: [],
            totalPages: 0,
            message: "",
            errorMessage: ""
        };
    },
    methods: {
        async findTypeOfContracts() {
            const res = await axios
                .get("type_of_contract/")
                .then(res => res.data.data)
                .catch(err => console.log(err));
            this.type_of_contracts = res.type_of_contracts;
        },
        async pagination(page) {
            this.page = page;
            const res = await axios
                .get("employee/?limit=" + this.limit + "&page=" + this.page)
                .then(res => res.data.data)
                .catch(err => console.log(err));
            this.employees = res.employees;
            this.totalPages = Math.ceil(res.total / this.limit);
        },
        async findOneEmployee(id) {
            const res = await axios
                .get("employee/?id=" + id)
                .then(res => res.data.data)
                .catch(err => console.log(err));
            this.employee = res;
        },
        async remove(id) {
            const res = await axios
                .delete("employee/delete?id=" + id)
                .then(res => res.data.data)
                .catch(err => console.log(err));
            this.message = res;
            this.page = 1;
            this.pagination(this.page);
        },
        async changeStatus(id) {
            const res = await axios
                .put("employee/change_status?id=" + id)
                .then(res => res.data.data)
                .catch(err => console.log(err));
            this.message = res;
            this.page = 1;
            this.pagination(this.page);
        },
        async save(employee) {
            try {
                this.errorMessage = "";
                const res = await axios.post("employee/save", {
                    employee: employee
                });
                this.message = res.data.data;
                this.clearData();
                this.changeModal();
                this.page = 1;
                this.pagination(this.page);
            } catch (error) {
                const message = error.response.data.error.message;
                if (typeof message === "string" || message instanceof String)
                    this.errorMessage = message;
                else
                    Object.entries(message).forEach(([key, value]) => {
                        this.errorMessage += value + "\n";
                    });
            }
        },
        changeModal(id = 0, disabled = 0) {
            if (id != 0) {
                this.titleModal = "Actualizar empleado";
                this.findOneEmployee(id);
            } else {
                this.titleModal = "Crear empleado";    
            }
            this.disabled = disabled;
            this.modal = !this.modal;
            this.clearData();
        },
        clearData() {
            if (!this.modal)
                this.employee = {
                    code: "",
                    name: "",
                    paternal_surname: "",
                    maternal_surname: "",
                    type_of_contract_id: 1,
                    email: "",
                    status: 1
                };
        }
    },
    created() {
        this.pagination(this.page);
        this.findTypeOfContracts();
    }
};
</script>

<style>
.show {
    display: list-item;
    opacity: 1;
    background: rgba(44, 38, 75, 0.849);
}

.modal-body {
    max-height: calc(100vh - 200px);
    overflow-y: auto;
}
pre {
    width: 100%;
}
</style>
