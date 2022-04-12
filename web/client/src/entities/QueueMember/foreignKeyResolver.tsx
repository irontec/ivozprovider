import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { QueueMemberPropertiesList } from './QueueMemberProperties';
import entities from '../index';

const foreignKeyResolver: foreignKeyResolverType = async function (
  { data },
): Promise<QueueMemberPropertiesList> {

  const { User } = entities;

  for (const row of data) {
    row.userId = row.user;
    row.userLink = User.path + `/${row.userId}/update`;
    row.user = User.toStr(row.user);
  }

  return data;
};

export default foreignKeyResolver;