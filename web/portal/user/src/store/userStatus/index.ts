import status, { StatusStore } from './status';

export interface UserStatusStore {
  status: StatusStore;
}

const userStatus: UserStatusStore = {
  status,
};

export default userStatus;
