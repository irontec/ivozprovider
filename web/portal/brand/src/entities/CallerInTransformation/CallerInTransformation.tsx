import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import TransformationRule from '../TransformationRule/TransformationRule';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const CallerInTransformation: EntityInterface = {
  ...TransformationRule,
  localPath: TransformationRule.path + '_callerin',
  title: _('Caller In Transformation', { count: 2 }),
};

export default CallerInTransformation;
