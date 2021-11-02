import { Actions, Thunk, thunk } from 'easy-peasy';
import ApiClient, { ApiError } from 'lib/services/api/ApiClient';

interface ApiState {
  errorMsg: string | null,
}

interface ApiActions {
  get: Thunk<() => Promise<void>, apiGetRequestParams>
  download: Thunk<() => Promise<void>, apiGetRequestParams>
  post: Thunk<() => Promise<void>, apiPostRequestParams>
  put: Thunk<() => Promise<void>, apiPutRequestParams>
  delete: Thunk<() => Promise<void>, apiDeleteRequestParams>
}

export type ApiStore = ApiState & ApiActions;

interface apiGetRequestParams {
  path: string,
  params: any,
  successCallback: (data: Record<string, any>, headers: Record<string, any>) => Promise<any>
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

const handleApiErrors = (error: ApiError | null, getStoreActions: () => Actions<any>): string | null => {

  if (!error) {
    throw error;
  }

  if ([400, 401].includes(error?.status || -1)) {
    const actions: any = getStoreActions();
    actions.auth.resetToken();
  }

  throw error.statusText;
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
    } catch (error: any) {

      console.log('api get error', error);
      handleApiErrors(error as ApiError, getStoreActions);
    }
  }),

  download: thunk(async (actions: any, payload: apiGetRequestParams, { getStoreActions }) => {

    const { path, params, successCallback } = payload;

    try {
      return await ApiClient.download(
        path,
        params,
        successCallback
      );
    } catch (error: any) {
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
    } catch (error: any) {
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
    } catch (error: any) {
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
    } catch (error: any) {
      console.log('api delete error', error);
      handleApiErrors(error as ApiError, getStoreActions);
    }
  }),
};

export default api;