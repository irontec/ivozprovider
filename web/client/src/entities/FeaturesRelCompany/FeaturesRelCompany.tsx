import AttachFileIcon from '@mui/icons-material/AttachFile';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import { EntityValues } from 'lib/services/entity/EntityService';

const FeaturesRelCompany: EntityInterface = {
    ...defaultEntityBehavior,
    icon: AttachFileIcon,
    iden: 'FeaturesRelCompany',
    title: _('FeaturesRelCompany', { count: 2 }),
    path: '/features_rel_companies',
    toStr: (row: EntityValues) => (row?.feature as EntityValues)?.iden as string || '',
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default FeaturesRelCompany;