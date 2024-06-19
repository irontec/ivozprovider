import { EntityValue, isEntityItem } from '@irontec/ivoz-ui';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import MilitaryTechIcon from '@mui/icons-material/MilitaryTech';

import {
  SpecialNumberProperties,
  SpecialNumberPropertyList,
} from './SpecialNumberProperties';

const properties: SpecialNumberProperties = {
  number: {
    label: _('Number'),
    pattern: new RegExp(`^[0-9]+$`),
  },
  disableCDR: {
    label: _('Disable CDR'),
    default: '1',
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(`Mark yes to hide this destination calls in all lists`),
  },
  country: {
    label: _('Country', { count: 1 }),
  },
};

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row } = props;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === SpecialNumber.iden
  ) {
    if (row.global) {
      return null;
    }
  }

  return DefaultChildDecorator(props);
};

const SpecialNumber: EntityInterface = {
  ...defaultEntityBehavior,
  icon: MilitaryTechIcon,
  link: '/doc/en/administration_portal/platform/global_special_numbers.html',
  iden: 'SpecialNumber',
  title: _('Global Special Number', { count: 2 }),
  path: '/special_numbers',
  toStr: (row: SpecialNumberPropertyList<EntityValue>) => row.number as string,
  properties,
  columns: ['country', 'number', 'disableCDR'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'SpecialNumbers',
  },
  ChildDecorator,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default SpecialNumber;
