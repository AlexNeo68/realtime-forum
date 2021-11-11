class Token {

    isValid(token) {
        const payload = this.payload(token);
        console.log(payload.iss);
        if (payload.iss) {
            return payload.iss == 'http://127.0.0.1:8000/api/auth/login' || payload.iss == 'http://127.0.0.1:8000/api/auth/signup';
        }
        return false;
    }

    payload(token) {
        return this.decode(token.split('.')[1]);
    }

    decode(payload) {
        return JSON.parse(atob(payload));
    }
}

export default Token = new Token;
