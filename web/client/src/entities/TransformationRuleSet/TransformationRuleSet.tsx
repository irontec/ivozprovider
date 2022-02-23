import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';

const transformationRuleSet: EntityInterface = {
    ...defaultEntityBehavior,
    icon: AccountTreeIcon,
    iden: 'TransformationRuleSet',
    title: _('TransformationRuleSet', { count: 2 }),
    path: '/transformation_rule_sets',
    toStr: (row: any) => row.name,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default transformationRuleSet;