import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';

const transformationRuleSet: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'TransformationRuleSet',
  title: _('TransformationRuleSet', { count: 2 }),
  path: '/transformation_rule_sets',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'TransformationRuleSets',
  },
  toStr: (row: any) => row.name,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default transformationRuleSet;