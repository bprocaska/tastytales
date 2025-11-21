export class Type {
    #id;
    #description;
    #apiBase;

    constructor(id, description) {
        this.#id = id;
        this.#description = description;
        this.#apiBase = "http://localhost/tastytales/api/types";
    }

    getId = function() { return this.#id; }
    getDescription = function() { return this.#description; }
    setId = function(id) { this.#id = id; }
    setDescription = function(description) { this.#description = description; }

    getById = async function(id) {
        try {
            const response = await fetch(`${this.#apiBase}/id/${id}`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("❌ Erro ao buscar tipo:", error);
            return null;
        }
    }

    getAll = async function() {
        try {
            const response = await fetch(`${this.#apiBase}/`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("❌ Erro ao buscar tipos:", error);
            return [];
        }
    }

    describe = function() {
        return `Type [ID: ${this.#id}, Description: ${this.#description}]`;
    }
}
