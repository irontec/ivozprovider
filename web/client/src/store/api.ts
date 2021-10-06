import { Actions, thunk } from 'easy-peasy';
import ApiClient, { ApiError } from 'lib/services/api/ApiClient';

interface apiGetRequestParams {
  path: string,
  params: any,
  successCallback: () => Promise<any>
}

interface apiPostRequestParams {
  path: string,
  values: any,
  contentType: string
}

interface apiPutRequestParams {
  path: string,
  values: any
}

interface apiDeleteRequestParams {
  path: string,
  params: any,
  successCallback: () => Promise<any>
}

const handleApiErrors = (error: ApiError | null, getStoreActions: () => Actions<any>) => {

  if (!error) {
    throw error;
  }

  if ([400, 401].includes(error?.status || -1)) {
    const actions: any = getStoreActions();
    actions.auth.resetToken();
  }

  throw error;
};

const api = {
  errorMsg: null,
  ////////////////////////////////////////
  // GET
  ////////////////////////////////////////
  get: thunk(async (actions: any, payload: apiGetRequestParams, { getStoreActions }) => {

    const { path, params, successCallback } = payload;

    try {
      return await ApiClient.get(
        path,
        params,
        successCallback
      );
    } catch (error) {

      console.log('api get error', error);
      handleApiErrors(error as ApiError, getStoreActions);
    }
  }),
  ////////////////////////////////////////
  // POST
  ////////////////////////////////////////
  post: thunk(async (actions: any, payload: apiPostRequestParams, { getStoreActions }) => {

    const { path, values, contentType } = payload;

    try {
      return await ApiClient.post(
        path,
        values,
        contentType
      );
    } catch (error) {
      console.log('api post error', error);
      handleApiErrors(error as ApiError, getStoreActions);
    }
  }),
  ////////////////////////////////////////
  // PUT
  ////////////////////////////////////////
  put: thunk(async (actions: any, payload: apiPutRequestParams, { getStoreActions }) => {

    const { path, values } = payload;

    try {
      return await ApiClient.put(
        path,
        values
      );
    } catch (error) {
      console.log('api put error', error);
      handleApiErrors(error as ApiError, getStoreActions);
    }
  }),
  ////////////////////////////////////////
  // DELETE
  ////////////////////////////////////////
  delete: thunk(async (actions: any, payload: apiDeleteRequestParams, { getStoreActions }) => {

    const { path } = payload;

    try {
      return await ApiClient.delete(
        path
      );
    } catch (error) {
      console.log('api delete error', error);
      handleApiErrors(error as ApiError, getStoreActions);
    }
  }),
};

export default api;
