import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import { CodecProperties } from './CodecProperties';

const properties: CodecProperties = {
  type: {
    label: _('Type'),
    enum: {
      audio: _('Audio'),
      video: _('Video'),
    },
  },
  iden: {
    label: _('Iden'),
  },
  name: {
    label: _('Name'),
  },
  id: {
    label: _('Id'),
  },
};

const Codec: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Codec',
  title: _('Codec', { count: 2 }),
  path: '/codecs',
  toStr: (row: any) => row.iden,
  properties,
  selectOptions,
};

export default Codec;
