import aboutMe, { AboutMeStore } from './aboutMe';

export interface ClientSessionStore {
  aboutMe: AboutMeStore;
}

const clientSession: ClientSessionStore = {
  aboutMe,
};

export default clientSession;
