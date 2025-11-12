export class User {
    #id;
    #idType;
    #name;
    #email;
    #password;
    #photo;
    #errorMessage;
    #apiBase;

    constructor(id, idType, name, email, password, photo) {
        this.#id = id;
        this.#idType = idType;
        this.#name = name;
        this.#email = email;
        this.#password = password;
        this.#photo = photo;
        this.#errorMessage = null;
        this.#apiBase = "http://localhost/tastytales/api/users";
    }

    // Getters
    getId = function() { return this.#id; }
    getIdType = function() { return this.#idType; }
    getName = function() { return this.#name; }
    getEmail = function() { return this.#email; }
    getPassword = function() { return this.#password; }
    getPhoto = function() { return this.#photo; }
    getErrorMessage = function() { return this.#errorMessage; }

    // Setters
    setId = function(id) { this.#id = id; }
    setIdType = function(idType) { this.#idType = idType; }
    setName = function(name) { this.#name = name; }
    setEmail = function(email) { this.#email = email; }
    setPassword = function(password) { this.#password = password; }
    setPhoto = function(photo) { this.#photo = photo; }

    // ===== Métodos da API =====

    login = async function(email, password) {
        try {
            const response = await fetch(`${this.#apiBase}/login`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();

            if (!response.ok) throw new Error(data.message || "Erro de login");

            return new User(data.id, data.idType, data.name, data.email, data.password, data.photo);
        } catch (error) {
            console.error("❌ Erro no login:", error);
            this.#errorMessage = error.message;
            return null;
        }
    }

    register = async function() {
        try {
            const response = await fetch(`${this.#apiBase}/create`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    idType: this.#idType,
                    name: this.#name,
                    email: this.#email,
                    password: this.#password,
                    photo: this.#photo
                })
            });

            const data = await response.json();

            if (!response.ok) throw new Error(data.message || "Erro ao registrar usuário");

            this.#id = data.id;
            return true;
        } catch (error) {
            this.#errorMessage = error.message;
            console.error("❌ Erro ao registrar:", error);
            return false;
        }
    }

    update = async function() {
        try {
            const response = await fetch(`${this.#apiBase}/update`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    id: this.#id,
                    idType: this.#idType,
                    name: this.#name,
                    email: this.#email,
                    password: this.#password,
                    photo: this.#photo
                })
            });

            const data = await response.json();
            if (!response.ok) throw new Error(data.message || "Erro ao atualizar usuário");

            return true;
        } catch (error) {
            this.#errorMessage = error.message;
            console.error("❌ Erro ao atualizar usuário:", error);
            return false;
        }
    }

    getById = async function(id) {
        try {
            const response = await fetch(`${this.#apiBase}/${id}`);
            const data = await response.json();

            if (!response.ok) throw new Error(data.message || "Erro ao buscar usuário");

            return new User(data.id, data.idType, data.name, data.email, data.password, data.photo);
        } catch (error) {
            console.error("❌ Erro ao buscar usuário:", error);
            return null;
        }
    }

    // ===== Métodos utilitários =====
    formLoad = function(form) {
        form.name.value = this.#name ?? "";
        form.email.value = this.#email ?? "";
    }

    describe = function() {
        return `User [ID: ${this.#id}, Name: ${this.#name}, Email: ${this.#email}]`;
    }
}
