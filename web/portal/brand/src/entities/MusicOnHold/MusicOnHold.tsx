import RadioIcon from '@mui/icons-material/Radio';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { MusicOnHoldProperties } from './MusicOnHoldProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: MusicOnHoldProperties = {
  name: {
    label: _('Name'),
  },
  status: {
    label: _('Status'),
    enum: {
      pending: _('Pending'),
      encoding: _('Encoding'),
      ready: _('Ready'),
      error: _('Error'),
    },
  },
  id: {
    label: _('Id'),
  },
  originalFile: {
    label: _('Uploaded file'),
    type: 'file',
    // TODO extensions: [ wav, mp3 ]
    // TODO size_limit: 20M
  },
  encodedFile: {
    label: _('File for play'),
    type: 'file',
    readOnly: true,
  },
};

const MusicOnHold: EntityInterface = {
  ...defaultEntityBehavior,
  icon: RadioIcon,
  iden: 'MusicOnHold',
  title: _('Generic Music on Hold', { count: 2 }),
  path: '/music_on_holds',
  toStr: (row: any) => row.id,
  properties,
  columns: ['name', 'originalFile'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default MusicOnHold;
