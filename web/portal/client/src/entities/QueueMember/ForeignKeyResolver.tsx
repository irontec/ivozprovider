import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { QueueMemberPropertiesList } from './QueueMemberProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
}): Promise<QueueMemberPropertiesList> {
  const entities = store.getState().entities.entities;
  const { User } = entities;

  for (const row of data) {
    row.userId = row.user;
    row.userLink = `${User.path}/${row.user.id}/update`;
    row.user = User.toStr(row.user);
  }

  return data;
};

export default foreignKeyResolver;
