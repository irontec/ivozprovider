import axios from 'axios';
import config from 'config';

type AsyncFunction = (data: any, headers: any) => Promise<void>

class ApiClient {
    static setToken(token: string) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    }

    static async get(endpoint: string, params: any = undefined, ...callbacks: Array<AsyncFunction>) {
        try {

            const response = await axios.get(
                config.API_URL + endpoint,
                {
                    params: params,
                    headers: {
                        'Accept': 'application/json'
                    },
                }
            );

            if (callbacks.length) {
                for (const idx in callbacks) {
                    await callbacks[idx](response.data, response.headers);
                }
            }

            return response;

        } catch (error) {
            throw error.response;
        }
    }

    static async post(endpoint: string, params: any = undefined, contentType: string) {
        const reqConfig = {
            headers: {
                'Content-Type': contentType
            }
        };

        if (contentType === 'application/x-www-form-urlencoded') {
            const reqParams = new URLSearchParams();
            for (var idx in params) {
                reqParams.append(idx, params[idx]);
            }

            params = reqParams;
        }

        return await axios.post(config.API_URL + endpoint, params, reqConfig);
    }

    static async put(endpoint: string, params: any = undefined) {
        return await axios.put(config.API_URL + endpoint, params);
    }

    static async delete(endpoint: string, params: any = undefined) {
        return await axios.delete(config.API_URL + endpoint, params);
    }
}

export default ApiClient;