export class Recipe {
    #id;
    #idCategory;
    #name;
    #preparationMethod;
    #preparationTime;
    #image;
    #createdAt;
    #updatedAt;
    #deletedAt;
    #apiBase;

    constructor(id, idCategory, name, preparationMethod, preparationTime, image, createdAt, updatedAt, deletedAt) {
        this.#id = id;
        this.#idCategory = idCategory;
        this.#name = name;
        this.#preparationMethod = preparationMethod;
        this.#preparationTime = preparationTime;
        this.#image = image;
        this.#createdAt = createdAt;
        this.#updatedAt = updatedAt;
        this.#deletedAt = deletedAt;
        this.#apiBase = "http://localhost/tastytales/api/recipes";
    }

    // Getters e Setters
    getId = function() { return this.#id; }
    getIdCategory = function() { return this.#idCategory; }
    getName = function() { return this.#name; }
    getPreparationMethod = function() { return this.#preparationMethod; }
    getPreparationTime = function() { return this.#preparationTime; }
    getImage = function() { return this.#image; }

    setId = function(id) { this.#id = id; }
    setIdCategory = function(idCategory) { this.#idCategory = idCategory; }
    setName = function(name) { this.#name = name; }
    setPreparationMethod = function(method) { this.#preparationMethod = method; }
    setPreparationTime = function(time) { this.#preparationTime = time; }
    setImage = function(image) { this.#image = image; }

    // ===== Métodos da API =====
    getAll = async function() {
        try {
            const response = await fetch(`${this.#apiBase}/`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("❌ Erro ao buscar receitas:", error);
            return [];
        }
    }

    getById = async function(id) {
        try {
            const response = await fetch(`${this.#apiBase}/id/${id}`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("❌ Erro ao buscar receita:", error);
            return null;
        }
    }

    create = async function() {
        try {
            const response = await fetch(`${this.#apiBase}/add`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    idCategory: this.#idCategory,
                    name: this.#name,
                    preparationMethod: this.#preparationMethod,
                    preparationTime: this.#preparationTime,
                    image: this.#image
                })
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("❌ Erro ao criar receita:", error);
            return null;
        }
    }

    update = async function() {
        try {
            const response = await fetch(`${this.#apiBase}/update`, {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    id: this.#id,
                    idCategory: this.#idCategory,
                    name: this.#name,
                    preparationMethod: this.#preparationMethod,
                    preparationTime: this.#preparationTime,
                    image: this.#image
                })
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("❌ Erro ao atualizar receita:", error);
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
            console.error("❌ Erro ao deletar receita:", error);
            return null;
        }
    }

    describe = function() {
        return `Recipe [ID: ${this.#id}, Name: ${this.#name}]`;
    }
}
