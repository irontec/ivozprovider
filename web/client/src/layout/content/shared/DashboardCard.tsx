import { StyledCard, StyledCardContent } from './DashboardCard.styles';

const DashboardCard = (props: any) => {

  const { children } = props;

  return (
    <StyledCard>
      <StyledCardContent>
        {children}
      </StyledCardContent>
    </StyledCard>
  );
};

export default DashboardCard;