import { thunk } from 'easy-peasy';
import ApiClient from 'services/Api/ApiClient';

interface apiGetRequestParams {
  path:string,
  params:any,
  successCallback: () => Promise<any>
}

interface apiPostRequestParams {
  path:string,
  values:any,
  contentType: string
}

interface apiPutRequestParams {
  path:string,
  values:any
}

interface apiDeleteRequestParams {
  path:string,
  params:any,
  successCallback: () => Promise<any>
}

const api = {
  errorMsg: null,
  ////////////////////////////////////////
  // GET
  ////////////////////////////////////////
  get: thunk(async (actions:any, payload: apiGetRequestParams, { getStoreActions }) => {

    const {path, params, successCallback} = payload;

    try {
      return await ApiClient.get(
        path,
        params,
        successCallback
      );
    } catch (error) {
      if ([400, 401].includes(error.status)) {
        console.log('error', error);
        const actions:any = getStoreActions();
        actions.auth.resetToken();

        throw error;
      }
    }
  }),
  ////////////////////////////////////////
  // POST
  ////////////////////////////////////////
  post: thunk(async (actions:any, payload: apiPostRequestParams, { getStoreActions }) => {

    const {path, values, contentType} = payload;

    try {
      return await ApiClient.post(
        path,
        values,
        contentType
      );
    } catch (error) {
      if ([400, 401].includes(error.status)) {
        console.log('error', error);
        const actions:any = getStoreActions();
        actions.auth.resetToken();

        throw error;
      }
    }
  }),
  ////////////////////////////////////////
  // PUT
  ////////////////////////////////////////
  put: thunk(async (actions:any, payload: apiPutRequestParams, { getStoreActions }) => {

    const {path, values} = payload;

    try {
      return await ApiClient.put(
        path,
        values
      );
    } catch (error) {
      if ([400, 401].includes(error.status)) {
        console.log('error', error);
        const actions:any = getStoreActions();
        actions.auth.resetToken();

        throw error;
      }
    }
  }),
  ////////////////////////////////////////
  // DELETE
  ////////////////////////////////////////
  delete: thunk(async (actions:any, payload: apiDeleteRequestParams, { getStoreActions }) => {

    const {path} = payload;

    try {
      return await ApiClient.delete(
        path
      );
    } catch (error) {
      if ([400, 401].includes(error.status)) {
        console.log('error', error);
        const actions:any = getStoreActions();
        actions.auth.resetToken();

        throw error;
      }
    }
  }),
};

export default api;
