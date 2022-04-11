import AttachFileIcon from '@mui/icons-material/AttachFile';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

const FeaturesRelCompany: EntityInterface = {
    ...defaultEntityBehavior,
    icon: AttachFileIcon,
    iden: 'FeaturesRelCompany',
    title: _('FeaturesRelCompany', { count: 2 }),
    path: '/features_rel_companies',
    acl: {
        ...defaultEntityBehavior.acl,
        iden: 'FeaturesRelCompanies',
    },
    toStr: (row: EntityValues) => (row?.feature as EntityValues)?.iden as string || '',
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default FeaturesRelCompany;