import { CustomActionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import Export from './Export';
import Import from './Import';

const customAction: CustomActionsType = {
  Import: {
    action: Import,
    global: true,
  },
  Export: {
    action: Export,
    global: true,
  },
};

export default customAction;
