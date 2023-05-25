import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import MoveDownIcon from '@mui/icons-material/MoveDown';
import { useStoreState } from 'store';

import { TransformationRuleSetPropertyList } from '../TransformationRuleSet/TransformationRuleSetProperties';
import {
  TransformationRuleProperties,
  TransformationRulePropertyList,
} from './TransformationRuleProperties';

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
    required: true,
  },
  matchExpr: {
    label: _('Match Expr'),
    maxLength: 64,
    required: true,
  },
  replaceExpr: {
    label: _('Replace expr'),
    maxLength: 64,
    required: true,
  },
  transformationRuleSet: {
    label: _('Numeric transformation', { count: 1 }),
    required: true,
  },
};

export const ChildDecorator: ChildDecoratorType = (props) => {
  const parent = useStoreState(
    (state) =>
      state.list.parentRow as TransformationRuleSetPropertyList<
        string | number | boolean
      >
  );

  if (parent?.editable !== true) {
    return null;
  }

  return DefaultChildDecorator(props);
};

const TransformationRule: EntityInterface = {
  ...defaultEntityBehavior,
  icon: MoveDownIcon,
  iden: 'TransformationRule',
  title: _('TransformationRule', { count: 2 }),
  path: '/transformation_rules',
  toStr: (row: TransformationRulePropertyList<EntityValues>) => `${row.id}`,
  properties,
  columns: ['description', 'priority', 'matchExpr', 'replaceExpr'],
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
  ChildDecorator,
};

export default TransformationRule;
