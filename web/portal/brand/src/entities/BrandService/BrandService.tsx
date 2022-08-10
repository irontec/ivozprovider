import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { BrandServiceProperties } from './BrandServiceProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: BrandServiceProperties = {
  code: {
    label: _('Code'),
    prefix: '<span class="asterisc">*</span>',
    pattern: new RegExp('[#0-9*]+'),
    helpText: _('Allowed characters are 0-9, * and #'),
  },
  id: {
    label: _('Id'),
  },
  service: {
    label: _('Service'),
  },
};

const BrandService: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'BrandService',
  title: _('BrandService', { count: 2 }),
  path: '/BrandServices',
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default BrandService;
