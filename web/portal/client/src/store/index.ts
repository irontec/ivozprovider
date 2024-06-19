import ApiClient from '@irontec/ivoz-ui/services/api/ApiClient';
import {
  IvozStore,
  StoreContainer,
  storeModel as ivozStoreModel,
} from '@irontec/ivoz-ui/store';
import {
  createStore,
  createTypedHooks,
  FilterActionTypes,
  StateMapper,
} from 'easy-peasy';

import config from '../config';
import clientSession, { ClientSessionStore } from './clientSession';

ApiClient.API_URL = config.API_URL;

export interface AppStore extends IvozStore {
  clientSession: ClientSessionStore;
}

export type IvozStoreState = StateMapper<FilterActionTypes<AppStore>>;

const storeModel: AppStore = {
  ...ivozStoreModel,
  clientSession,
};

const store = createStore<AppStore>(storeModel);
StoreContainer.store = store;

export default store;

const { useStoreActions, useStoreState, useStoreDispatch, useStore } =
  createTypedHooks<AppStore>();

export { useStore, useStoreActions, useStoreDispatch, useStoreState };
