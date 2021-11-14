import AppStorage from "./AppStorage";
import Token from "./Token";
class User {
    async login(data) {
        try {
            const res = await axios.post("/api/auth/login", data);
            this.responseAftreLogin(res.data);
        } catch (error) {
            throw error;
        }
    }

    async signup(data) {
        try {
            const res = await axios.post("/api/auth/signup", data);
            this.responseAftreLogin(res.data);
        } catch (error) {
            console.log(error.response);
            throw error;
        }
    }

    responseAftreLogin({ access_token, user }) {
        if (Token.isValid(access_token)) {
            AppStorage.store(access_token, user);
            window.location = '/forum';
        }

    }

    hasToken() {
        const token = AppStorage.getToken();
        if (token) {
            return Token.isValid(token);
        }
        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    logout() {
        AppStorage.clear();
        window.location = '/forum';
    }

    name() {
        if (this.loggedIn()) return AppStorage.getUser()
    }

    id() {
        if (this.loggedIn()) {
            const payload = Token.payload(AppStorage.getToken());
            if (payload) return payload.sub;
        }
        return null;
    }

    own(id) {
        return this.id() === id
    }

    isAdmin() {
        return this.id() === 15
    }


}

export default User = new User();
