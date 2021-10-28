import auth, { AuthStore } from './auth';
import spec, { SpecStore } from './apiSpec';
import api, { ApiStore } from './api';
import route, { RouteStore } from './route';
import { createTypedHooks } from 'easy-peasy';

interface AppStore {
  auth: AuthStore,
  spec: SpecStore,
  api: ApiStore,
  route: RouteStore
}

const {
  useStoreActions,
  useStoreState,
  useStoreDispatch,
  useStore
} = createTypedHooks<AppStore>();

export {
  useStoreActions,
  useStoreState,
  useStoreDispatch,
  useStore
};

export default {
  auth,
  apiSpec: spec,
  api,
  route
}
