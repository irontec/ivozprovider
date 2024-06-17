import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';

import TransformationRule from '../TransformationRule/TransformationRule';

const CallerOutTransformation: EntityInterface = {
  ...TransformationRule,
  localPath: `${TransformationRule.path}_callerout`,
  title: _('Caller Out Transformation', { count: 2 }),
};

export default CallerOutTransformation;
