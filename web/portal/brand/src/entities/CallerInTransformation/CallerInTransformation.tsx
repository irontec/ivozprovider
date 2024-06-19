import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import TransformationRule from '../TransformationRule/TransformationRule';

const CallerInTransformation: EntityInterface = {
  ...TransformationRule,
  localPath: `${TransformationRule.path}_callerin`,
  title: _('Caller In Transformation', { count: 2 }),
};

export default CallerInTransformation;
