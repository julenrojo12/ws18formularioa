<?xml version="1.0" encoding="iso-8859-1"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <HTML>
      <BODY>
        <p>
          XML DOKUMENTUAREN BIHURKETA HTML TAULA BATEAN
        </p>
        <TABLE border="1">
          <THEAD>
            <TR>
              <TH>ePosta</TH>
              <TH>Galdera</TH>
              <TH>eZuzena</TH>
              <TH>eOkerrak</TH>
              <TH>Gaia</TH>
            </TR>
          </THEAD>

    <xsl:for-each select="/assessmentItems/assessmentItem">
          <TR>
            <TD>
              <FONT SIZE="2" COLOR="red" FACE="Verdana">
                <xsl:value-of select="@author"/>
                <BR/>
              </FONT>
            </TD>
            <TD>
              <FONT SIZE="2" COLOR="blue" FACE="Verdana">
                <xsl:value-of select="itemBody/p"/>
                <BR/>
              </FONT>
            </TD>
            <TD>
              <FONT SIZE="2" COLOR="blue" FACE="Verdana">
                <xsl:value-of select="correctResponse/value"/>
              </FONT>
            </TD>
            <TD>
              <FONT SIZE="2" COLOR="blue" FACE="Verdana">
                <ul>
                  <xsl:for-each select="incorrectResponses/value">
                    <li>
                      <xsl:value-of select="."/> 
                    </li>
                    
                  </xsl:for-each>
                </ul>
                
              </FONT>
            </TD>
            <TD>
              <FONT SIZE="2" COLOR="blue" FACE="Verdana">
                <xsl:value-of select="@subject"/>
              </FONT>
            </TD>
          </TR>
        </xsl:for-each>
       </TABLE>
      </BODY>
    </HTML>
  </xsl:template>  
</xsl:stylesheet>