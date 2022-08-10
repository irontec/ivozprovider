import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { TransformationRuleProperties } from './TransformationRuleProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: TransformationRuleProperties = {
  type: {
    label: _('Type'),
    enum: {
      callerin: _('Callerin'),
      calleein: _('Calleein'),
      callerout: _('Callerout'),
      calleeout: _('Calleeout'),
    },
  },
  description: {
    label: _('Description'),
    maxLength: 64,
  },
  priority: {
    label: _('Priority'),
  },
  matchExpr: {
    label: _('Match Expr'),
    maxLength: 64,
  },
  replaceExpr: {
    label: _('Replace expr'),
    maxLength: 64,
  },
  transformationRuleSet: {
    label: _('Numeric transformation'),
  },
};

const TransformationRule: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'TransformationRule',
  title: _('TransformationRule', { count: 2 }),
  path: '/TransformationRules',
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default TransformationRule;
