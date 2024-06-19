import { CustomActionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import Export from './Export';
import Rerate from './Rerate';

const customAction: CustomActionsType = {
  Export: {
    action: Export,
    global: true,
  },
  Rerate: {
    action: Rerate,
    multiselect: true,
  },
};

export default customAction;
