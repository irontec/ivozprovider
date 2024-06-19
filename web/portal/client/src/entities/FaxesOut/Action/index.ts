import { CustomActionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import Resend from './Resend';

const customAction: CustomActionsType = {
  Resend: {
    action: Resend,
    multiselect: false,
  },
};

export default customAction;
