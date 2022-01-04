import { CancelToken } from 'axios';
import { action, Action, Actions, Computed, computed, Thunk, thunk } from 'easy-peasy';
import ApiClient, { ApiError } from 'lib/services/api/ApiClient';
import { KeyValList } from 'lib/services/api/ParsedApiSpecInterface';
import { EntityValues } from 'lib/services/entity/EntityService';

const handleApiErrors = (
  error: ApiError | null, getStoreActions: () => Actions<any>
): string | null => {

  if (!error) {
    throw error;
  }

  if ([401].includes(error?.status || -1)) {
    const actions: any = getStoreActions();
    actions.auth.resetToken();
  }

  throw error.statusText;
};

const api: ApiStore = {
  errorMsg: null,
  ongoingRequests: 0,
  setErrorMsg: action<ApiState, string>((state, errorMsg) => {
    state.errorMsg = errorMsg;
  }),
  loading: computed<ApiState, boolean>((state) => { return state.ongoingRequests > 0 }),
  sumRequest: action((state) => {
    state.ongoingRequests += 1;
  }),
  restRequest: action((state) => {
    state.ongoingRequests = Math.max(
      (state.ongoingRequests - 1),
      0
    );
  }),
  ////////////////////////////////////////
  // GET
  ////////////////////////////////////////
  get: thunk(async (actions: any, payload: apiGetRequestParams, { getStoreActions }) => {

    actions.sumRequest();
    actions.setErrorMsg(null);
    const { path, params, successCallback, cancelToken } = payload;

    try {
      const resp = await ApiClient.get(
        path,
        params,
        successCallback,
        cancelToken
      );
      actions.restRequest();

      return resp;

    } catch (error: any) {

      actions.restRequest();
      actions.setErrorMsg(error?.statusText);
      handleApiErrors(error as ApiError, getStoreActions);
    }
  }),

  download: thunk(async (actions: any, payload: apiGetRequestParams, { getStoreActions }) => {

    const { path, params, successCallback, cancelToken } = payload;
    actions.setErrorMsg(null);

    try {
      return await ApiClient.download(
        path,
        params,
        successCallback,
        cancelToken
      );
    } catch (error: any) {
      actions.setErrorMsg(error?.statusText);
      handleApiErrors(error as ApiError, getStoreActions);
    }
  }),

  ////////////////////////////////////////
  // POST
  ////////////////////////////////////////
  post: thunk(async (actions: any, payload: apiPostRequestParams, { getStoreActions }) => {

    const { path, values, contentType, cancelToken } = payload;
    actions.setErrorMsg(null);

    try {
      return await ApiClient.post(
        path,
        values,
        contentType,
        cancelToken
      );
    } catch (error: any) {
      actions.setErrorMsg(error?.statusText);
      handleApiErrors(error as ApiError, getStoreActions);
    }
  }),
  ////////////////////////////////////////
  // PUT
  ////////////////////////////////////////
  put: thunk(async (actions: any, payload: apiPutRequestParams, { getStoreActions }) => {

    const { path, values, cancelToken } = payload;
    actions.setErrorMsg(null);

    try {
      return await ApiClient.put(
        path,
        values,
        cancelToken
      );
    } catch (error: any) {
      actions.setErrorMsg(error?.statusText);
      handleApiErrors(error as ApiError, getStoreActions);
    }
  }),
  ////////////////////////////////////////
  // DELETE
  ////////////////////////////////////////
  delete: thunk(async (actions: any, payload: apiDeleteRequestParams, { getStoreActions }) => {

    const { path, cancelToken } = payload;
    actions.setErrorMsg(null);

    try {
      return await ApiClient.delete(
        path,
        cancelToken
      );
    } catch (error: any) {
      actions.setErrorMsg(error?.statusText);
      handleApiErrors(error as ApiError, getStoreActions);
    }
  }),
};

export default api;

interface apiGetRequestParams {
  path: string,
  params: KeyValList,
  successCallback: (data: Record<string, any>, headers: Record<string, any>) => Promise<any>,
  cancelToken?: CancelToken,
}

interface apiPostRequestParams {
  path: string,
  values: FormData | EntityValues,
  contentType: string,
  cancelToken?: CancelToken,
}

interface apiPutRequestParams {
  path: string,
  values: FormData | EntityValues,
  cancelToken?: CancelToken,
}

interface apiDeleteRequestParams {
  path: string,
  successCallback: () => Promise<any>,
  cancelToken?: CancelToken,
}

interface ApiState {
  errorMsg: string | null,
  ongoingRequests: number,
  loading: Computed<ApiState, boolean>,
}

interface ApiActions {
  setErrorMsg: Action<ApiState, string>
  sumRequest: Action<ApiState>,
  restRequest: Action<ApiState>,
  get: Thunk<() => Promise<void>, apiGetRequestParams>
  download: Thunk<() => Promise<void>, apiGetRequestParams>
  post: Thunk<() => Promise<void>, apiPostRequestParams>
  put: Thunk<() => Promise<void>, apiPutRequestParams>
  delete: Thunk<() => Promise<void>, apiDeleteRequestParams>
}

export type ApiStore = ApiState & ApiActions;