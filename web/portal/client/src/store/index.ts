import clientSession, { ClientSessionStore } from './clientSession';
import { createStore, createTypedHooks } from 'easy-peasy';
import {
  storeModel as ivozStoreModel,
  IvozStore,
  StoreContainer,
} from '@irontec/ivoz-ui/store';
import ApiClient from '@irontec/ivoz-ui/services/api/ApiClient';
import config from '../config';

ApiClient.API_URL = config.API_URL;

export interface AppStore extends IvozStore {
  clientSession: ClientSessionStore;
}

const storeModel: AppStore = {
  ...ivozStoreModel,
  clientSession,
};

const store = createStore<AppStore>(storeModel);
StoreContainer.store = store;

export default store;

const { useStoreActions, useStoreState, useStoreDispatch, useStore } =
  createTypedHooks<AppStore>();

export { useStoreActions, useStoreState, useStoreDispatch, useStore };
