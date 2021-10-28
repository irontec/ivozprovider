import axios, { AxiosError, AxiosResponse } from 'axios';
import config from 'config';

type AsyncFunction = (data: any, headers: any) => Promise<void>
export type ApiError = AxiosResponse | null;

class ApiClient {
    static setToken(token: string): void {
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    }

    static async get(endpoint: string, params: any = undefined, callback: AsyncFunction): Promise<unknown> {
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

            await callback(response.data, response.headers);

            return response;

        } catch (error: any) {

            if (!error) {
                throw error;
            }

            const axiosError = error as AxiosError;
            if (axiosError?.response?.status === 403) {
                await callback([], axiosError.response.headers);
                return;
            }

            throw axiosError.response;
        }
    }

    static async download(endpoint: string, params: any = undefined, callback: AsyncFunction): Promise<unknown> {
        try {

            const response = await axios.get(
                config.API_URL + endpoint,
                {
                    params: params,
                    headers: {
                        'Accept': 'application/json'
                    },
                    responseType: 'blob',
                }
            );

            await callback(response.data, response.headers);

            return response;

        } catch (error: any) {

            if (!error) {
                throw error;
            }

            const axiosError = error as AxiosError;
            if (axiosError?.response?.status === 403) {
                await callback([], axiosError.response.headers);
                return;
            }

            throw axiosError.response;
        }
    }

    static async post<T = any>(endpoint: string, params: any = undefined, contentType: string): Promise<T> {
        const reqConfig = {
            headers: {
                'Content-Type': contentType
            }
        };

        if (contentType === 'application/x-www-form-urlencoded') {
            const reqParams = new URLSearchParams();
            for (const idx in params) {
                reqParams.append(idx, params[idx]);
            }

            params = reqParams;
        }

        try {
            return await axios.post(config.API_URL + endpoint, params, reqConfig);
        } catch (error: any) {
            if (!error) {
                throw error;
            }

            throw (error as AxiosError).response;
        }
    }

    static async put<T = any>(endpoint: string, params: any = undefined): Promise<T> {
        try {
            return await axios.put(config.API_URL + endpoint, params);
        } catch (error: any) {
            if (!error) {
                throw error;
            }

            throw (error as AxiosError).response;
        }
    }

    static async delete<T = any>(endpoint: string, params: any = undefined): Promise<T> {
        try {
            return await axios.delete(config.API_URL + endpoint, params);
        } catch (error: any) {
            if (!error) {
                throw error;
            }

            throw (error as AxiosError).response;
        }
    }
}

export default ApiClient;