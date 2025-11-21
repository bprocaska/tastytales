export class Category {
    #id;
    #name;
    #apiBase;

    constructor(id, name) {
        this.#id = id;
        this.#name = name;
        this.#apiBase = "http://localhost/tastytales/api/categories";
    }

    getId = function() { return this.#id; }
    getName = function() { return this.#name; }
    setId = function(id) { this.#id = id; }
    setName = function(name) { this.#name = name; }

    getAll = async function() {
        try {
            const response = await fetch(`${this.#apiBase}/`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("❌ Erro ao buscar categorias:", error);
            return [];
        }
    }

    getById = async function(id) {
        try {
            const response = await fetch(`${this.#apiBase}/id/${id}`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("❌ Erro ao buscar categoria:", error);
            return null;
        }
    }

    create = async function() {
        try {
            const response = await fetch(`${this.#apiBase}/add`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ name: this.#name })
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("❌ Erro ao criar categoria:", error);
            return null;
        }
    }

    update = async function() {
        try {
            const response = await fetch(`${this.#apiBase}/update`, {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: this.#id, name: this.#name })
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("❌ Erro ao atualizar categoria:", error);
            return null;
        }
    }

    delete = async function() {
        try {
            const response = await fetch(`${this.#apiBase}/delete/id/${this.#id}`, {
                method: "DELETE"
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("❌ Erro ao deletar categoria:", error);
            return null;
        }
    }

    describe = function() {
        return `Category [ID: ${this.#id}, Name: ${this.#name}]`;
    }
}
