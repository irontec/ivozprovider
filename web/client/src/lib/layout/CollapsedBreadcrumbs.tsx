import Breadcrumbs from '@mui/material/Breadcrumbs';
import { useStoreState } from 'easy-peasy';
import _ from 'lib/services/translations/translate';
import {
  StyledCollapsedBreadcrumbsLink, StyledCollapsedBreadcrumbsNavigateNextIcon,
  StyledCollapsedBreadcrumbsTypography, StyledHomeIcon
} from './CollapsedBreadcrumbs.styles';

export default function CollapsedBreadcrumbs() {

  const currentRoute = useStoreState((state: any) => state.route.route);
  const currentRouteName = useStoreState((state: any) => state.route.name);
  const routeSegments = currentRoute.split('/').filter((segment: string) => {
    return segment;
  });
  const parsedSegments: Array<string> = [];

  return (
    <Breadcrumbs
      maxItems={3}
      separator={<StyledCollapsedBreadcrumbsNavigateNextIcon />}
      aria-label="breadcrumb"
    >
      <StyledCollapsedBreadcrumbsLink to={''}>
        <StyledHomeIcon />
      </StyledCollapsedBreadcrumbsLink>
      {routeSegments.map((segment: string, key: number) => {

        parsedSegments.push(segment);

        if ((/^:.+/).test(segment)) {
          return null;
        }

        const noLink =
          ['create', 'detailed', 'update'].includes(segment);

        if (noLink) {
          const translatedSegment = _(segment[0].toUpperCase() + segment.substring(1));
          return (
            <StyledCollapsedBreadcrumbsTypography key={key}>{translatedSegment}</StyledCollapsedBreadcrumbsTypography>
          );
        }

        const to = '/' + parsedSegments.join('/');
        return (
          <StyledCollapsedBreadcrumbsLink to={to} key={key}>
            {currentRouteName}
          </StyledCollapsedBreadcrumbsLink>
        );
      })}

    </Breadcrumbs>
  );
}
