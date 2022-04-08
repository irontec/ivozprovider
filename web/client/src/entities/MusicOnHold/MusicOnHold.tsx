import AudiotrackIcon from '@mui/icons-material/Audiotrack';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { MusicOnHoldProperties } from './MusicOnHoldProperties';

const properties: MusicOnHoldProperties = {
    'name': {
        label: _('Name'),
    },
    'originalFile': {
        label: _('Uploaded file'),
        type: 'file'
    }
};

const musicOnHold: EntityInterface = {
    ...defaultEntityBehavior,
    icon: AudiotrackIcon,
    iden: 'MusicOnHold',
    title: _('Music on hold', { count: 2 }),
    path: '/music_on_holds',
    properties,
    acl: {
        ...defaultEntityBehavior.acl,
        iden: 'MusicOnHold',
    },
};

export default musicOnHold;