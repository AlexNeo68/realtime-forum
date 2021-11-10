import AppStorage from "./AppStorage";
import Token from "./Token";
class User {
    async login(data) {
        try {
            const res = await axios.post("/api/auth/login", data);
            this.responseAftreLogin(res.data);
        } catch (error) {
            console.log(error);
        }
    }

    responseAftreLogin({ access_token, user }) {
        if (Token.isValid(access_token)) {
            AppStorage.store(access_token, user);
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


}

export default User = new User();
