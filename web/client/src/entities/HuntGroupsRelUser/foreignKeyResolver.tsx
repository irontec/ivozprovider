import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import { HuntGroupsRelUserPropertiesList } from './HuntGroupsRelUserProperties';
import entities from '../index';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data }
): Promise<HuntGroupsRelUserPropertiesList> {

    const { HuntGroup } = entities;
    const iterable = Array.isArray(data)
        ?  data
        : [data];

    for (const idx in iterable) {
        if (typeof iterable[idx].huntGroup === 'string') {
            continue;
        }

        iterable[idx]['huntGroupId'] = iterable[idx].huntGroup.id;
        //data[idx]['huntGroupLink'] = HuntGroup.path + '/edit/' + data[idx].huntGroup.id;
        iterable[idx].huntGroup = HuntGroup.toStr(iterable[idx].huntGroup)
    }

    return data;
}

export default foreignKeyResolver;