import clientSession, { ClientSessionStore } from './clientSession';
import { createStore, createTypedHooks } from 'easy-peasy';

export interface AppStore {
  clientSession: ClientSessionStore
}

const storeModel: AppStore = {
  clientSession
}

const store = createStore<AppStore>(storeModel);

export default store;

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