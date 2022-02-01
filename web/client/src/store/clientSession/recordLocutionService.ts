import { action, Action, Computed, computed, Thunk, thunk } from 'easy-peasy';
import { CancelTokenSource } from 'axios';
import { AppStore } from 'store';

type NullableRecordType = Record<string, string | number> | null;

interface RecordLocutionServiceState {
  loading: boolean,
  serviceEnabled: Computed<RecordLocutionServiceState, boolean>,
  recordLocutionService: NullableRecordType,
  companyRecordLocutionService: NullableRecordType,
}

interface CancelTokenSourceProps {
  cancelTokenSource: CancelTokenSource
}

type loadCompanyRecordLocutionServiceProps = CancelTokenSourceProps & { id:number };

interface RecordLocutionServiceActions {
  reset: Action<RecordLocutionServiceState, void>,
  setLoading: Action<RecordLocutionServiceState, void>,
  unsetLoading: Action<RecordLocutionServiceState, void>,
  setRecordLocutionService: Action<RecordLocutionServiceState, NullableRecordType>,
  setCompanyRecordLocutionService: Action<RecordLocutionServiceState, NullableRecordType>,

  load: Thunk<RecordLocutionServiceStore, CancelTokenSourceProps>,
  loadRecordLocutionService: Thunk<RecordLocutionServiceStore, CancelTokenSourceProps>,
  loadCompanyRecordLocutionService: Thunk<() => Promise<void>, loadCompanyRecordLocutionServiceProps, any, AppStore>,
}

export type RecordLocutionServiceStore = RecordLocutionServiceActions & RecordLocutionServiceState;

// TODO reset after a login
const recordLocutionService: RecordLocutionServiceStore  = {
  loading: false,
  recordLocutionService: null,
  companyRecordLocutionService: null,
  serviceEnabled: computed<RecordLocutionServiceState, boolean>((state) => {
    return state.recordLocutionService !== null && state.companyRecordLocutionService !== null;
  }),
  ///////////////////////////////
  // Actions
  ///////////////////////////////
  reset: action<RecordLocutionServiceState, void>((state: any) => {
    state.loading = false;
    state.recordLocutionService = null;
    state.companyRecordLocutionService = null;
  }),
  setLoading: action<RecordLocutionServiceState, void>((state: any) => {
    state.loading = true;
  }),
  unsetLoading: action<RecordLocutionServiceState, void>((state: any) => {
    state.loading = false;
  }),
  setRecordLocutionService: action<RecordLocutionServiceState, NullableRecordType>(
    (state, recordLocutionService) => {
      state.recordLocutionService = recordLocutionService;
    }
  ),
  setCompanyRecordLocutionService: action<RecordLocutionServiceState, NullableRecordType>(
    (state, companyRecordLocutionService) => {
      state.companyRecordLocutionService = companyRecordLocutionService;
    }
  ),
  ///////////////////////////////
  // Thunks
  ///////////////////////////////
  load: thunk<RecordLocutionServiceStore, CancelTokenSourceProps>(
    async (actions, { cancelTokenSource }, {getState}) => {

      const state = getState();
      if (state.loading) {
        return;
      }

      actions.setLoading();

      const recordLocutionService = await actions.loadRecordLocutionService({cancelTokenSource});
      if (recordLocutionService) {
        actions.loadCompanyRecordLocutionService({id: recordLocutionService.id, cancelTokenSource})
      }
    }
  ),
  loadRecordLocutionService: thunk<RecordLocutionServiceStore, CancelTokenSourceProps, any, AppStore>(
    async (actions, { cancelTokenSource }, {getStoreActions}) => {

      const apiGet = getStoreActions().api.get;

      const resp = await apiGet({
        path: '/services',
        params: {iden: 'RecordLocution'},
        successCallback: async () => { return; },
        cancelToken: cancelTokenSource.token
      });

      if (! resp?.data?.length) {
          return;
      }

      const recordLocutionService = resp?.data[0];
      actions.setRecordLocutionService(recordLocutionService);

      return recordLocutionService;
    }
  ),
  loadCompanyRecordLocutionService: thunk<RecordLocutionServiceStore, loadCompanyRecordLocutionServiceProps, any, AppStore>(
    async (actions, { id, cancelTokenSource }, { getStoreActions }) => {

      const apiGet = getStoreActions().api.get;

      const resp = await apiGet({
        path: '/company_services',
        params: {service: id},
        successCallback: async () => { return; },
        cancelToken: cancelTokenSource.token
      });

      if (! resp?.data?.length) {
          return;
      }

      const companyRecordLocutionService = resp?.data[0];
      actions.setCompanyRecordLocutionService(companyRecordLocutionService);

      return companyRecordLocutionService;
    }
  ),
};

export default recordLocutionService;