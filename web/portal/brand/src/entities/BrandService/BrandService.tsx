import BuildIcon from '@mui/icons-material/Build';
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
    prefix: <span className="asterisc">*</span>,
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
  icon: BuildIcon,
  iden: 'BrandService',
  title: _('Brand service', { count: 2 }),
  path: '/brand_services',
  toStr: (row: any) => row.id,
  properties,
  columns: ['service', 'code'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default BrandService;
