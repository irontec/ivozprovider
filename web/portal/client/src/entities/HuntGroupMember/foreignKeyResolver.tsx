import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import { HuntGroupMemberPropertiesList } from './HuntGroupMemberProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
}): Promise<HuntGroupMemberPropertiesList> {
  const entities = store.getState().entities.entities;
  const { HuntGroup } = entities;
  const iterable = Array.isArray(data) ? data : [data];

  for (const idx in iterable) {
    if (typeof iterable[idx].huntGroup === 'string') {
      continue;
    }

    iterable[idx].huntGroupId = iterable[idx].huntGroup.id;
    //data[idx]['huntGroupLink'] = HuntGroup.path + '/edit/' + data[idx].huntGroup.id;
    iterable[idx].huntGroup = HuntGroup.toStr(iterable[idx].huntGroup);
  }

  return data;
};

export default foreignKeyResolver;
