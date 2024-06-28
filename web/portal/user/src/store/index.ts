import ApiClient from '@irontec/ivoz-ui/services/api/ApiClient';
import {
  IvozStore,
  StoreContainer,
  storeModel as ivozStoreModel,
} from '@irontec/ivoz-ui/store';
import { createStore, createTypedHooks } from 'easy-peasy';

import config from '../config';
import userStatus, { UserStatusStore } from './userStatus';

ApiClient.API_URL = config.API_URL;

export interface AppStore extends IvozStore {
  userStatus: UserStatusStore;
}

const storeModel: AppStore = {
  ...ivozStoreModel,
  userStatus,
};

const store = createStore<AppStore>(storeModel);
StoreContainer.store = store;

export default store;

const { useStoreActions, useStoreState, useStoreDispatch, useStore } =
  createTypedHooks<AppStore>();

export { useStore, useStoreActions, useStoreDispatch, useStoreState };
