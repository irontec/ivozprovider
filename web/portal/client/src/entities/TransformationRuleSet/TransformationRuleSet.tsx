import { EntityValues } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

const transformationRuleSet: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'TransformationRuleSet',
  title: _('Transformation RuleSet', { count: 2 }),
  path: '/transformation_rule_sets',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'TransformationRuleSets',
  },
  toStr: (row: EntityValues) => `${row.name}`,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default transformationRuleSet;
