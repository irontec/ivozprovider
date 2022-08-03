import UsersCdr from './UsersCdr/UsersCdr';
import User from './User/User';
import Account from './Account/Account';
import Preferences from './Preferences/Preferences';
import Extension from './Extension/Extension';
import Country from './Country/Country';
import Voicemail from './Voicemail/Voicemail';
import { EntityList } from '@irontec/ivoz-ui';
import CallForwardSetting from './CallForwardSetting/CallForwardSetting';
import Timezone from './Timezone/Timezone';
import store from 'store';

const entities: EntityList = {
  Voicemail,
  Country,
  Extension,
  User,
  UsersCdr,
  Account,
  Preferences,
  Timezone,
  CallForwardSetting,
};

const storeActions = store.getActions();
storeActions.entities.setEntities(entities);

export default entities;
